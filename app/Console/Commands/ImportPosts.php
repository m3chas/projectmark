<?php

namespace App\Console\Commands;

use App\Post;
use App\User;
use App\LogImport;
use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;

class ImportPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import posts from external blogging platform: https://sq1-api-test.herokuapp.com/posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Time of started import.
        $started_at = now();

        // Let's check if user admin is created, if not cancel.
        $user = User::find(1);
        if (!$user) {
            $this->info("Error, can't continue if admin user is not created!");
            return;
        }

        // Let's get the external URL from env.
        $url = env('EXTERNAL_URL', 'https://sq1-api-test.herokuapp.com/posts');
        
        // Let's call a GET HTTP request.
        $response = Http::get($url);

        // Let's see if no error returned before continue.
        if ($response->failed() || $response->clientError() || $response->serverError()) {
            $this->info("Error: The server at url responded with error!");
            return;
        }

        // Let's iterate over each post of the data returned to be imported.
        $postToImport = $response->json();
        foreach ($postToImport['data'] as $post) {

            // Let's see if this post already exist on our system.
            // This should be easer with an legacy ID or external ID on the feed.
            // Since I already included a legacy,external ID on the post table to save it for future comparisions.
            $checkPost = Post::where('title', $post['title'])->where('publication_date', $post['publication_date'])->exists();
            if ($checkPost) {
                $this->info("This post already exist on our system!");
                // Let's continue to the next one.
                continue;
            }

            // Create a new post assigned to user id 1, in this case, admin, using the relationship create method.
            $newPost = $user->posts()->create([
                'title' => $post['title'],
                'description' => $post['description'],
                'publication_date' => $post['publication_date']
            ]);
            $this->info("Imported post: {{$post['title']}}");
        }

        // TODO: Send an email to an administrator each time an import was success.

        // Let's add a new log import.
        $logImport = new LogImport;
        $logImport->posts_imported = count($postToImport['data']);
        $logImport->started_at = $started_at;
        $logImport->finished_at = now();
        $logImport->status = "SUCCESS";
        $logImport->save();

        $this->info("Import done.");
    }
}