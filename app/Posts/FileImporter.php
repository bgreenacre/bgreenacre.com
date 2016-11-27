<?php

namespace Bgreenacre\Posts;

use Exception;
use Illuminate\Contracts\Filesystem\Filesystem;
use Bgreenacre\Users\UserModel;
use Bgreenacre\Roles\RoleModel;
use Bgreenacre\Types\TypeModel;
use Bgreenacre\TaxonomyTerms\TaxonomyTermModel;

class FileImporter {

	protected $fileSystem;
	protected $posts;
	protected $users;
	protected $roles;
	protected $types;
	protected $terms;

	public function __construct(
		PostModel $posts,
		UserModel $users,
		RoleModel $roles,
		TypeModel $types,
		TaxonomyTermModel $terms
	)
	{
		$this->posts = $posts;
		$this->users = $users;
		$this->roles = $roles;
		$this->types = $types;
		$this->terms = $terms;
	}

	public function import($filePath)
	{
		$content = file_get_contents($filePath);
		$parts   = preg_split('/[\n]*[-]{3}[\n]/', $content, 2);

		if (empty($parts) || count($parts) <= 1)
		{
			throw new Exception(
				sprintf(
					'Could not import file "%s" as it\'s missing config meta',
					pathinfo($filePath, PATHINFO_FILENAME)
				)
			);
		}

		$meta    = yaml_parse($parts[0]);
		$body    = trim($parts[1]);
		$post = $this->posts->where('title', array_get($meta, 'title'))->get();

		if ($post->count() == 0)
		{
			$post = clone $this->posts;
		}


		$publishDate = (preg_match('/[0-9]{2,4}-[0-9]{2}-[0-9]{2}/', $filePath, $match) > 0)
					 ? $match[0] : null;

		$post->status       = array_get($meta, 'Status', 'publish');
		$post->slug         = array_get($meta, 'Title');
		$post->title        = array_get($meta, 'Title');
		$post->publish_date = array_get($meta, 'Publish', $publishDate);
		$post->excerpt      = array_get($meta, 'Excerpt');
		$post->template     = array_get($meta, 'Template', 'pages.post');
		$post->is_in_menu   = array_get($meta, 'IsInMenu', false);
		$post->order 		= array_get($meta, 'Order');
		$post->content      = $body;

		$type = $this->types
			->forPosts()
			->where('name', array_get($meta, 'Type', 'article'), 'post')
			->get();

		if ($type->count() > 0)
		{
			$post->type()->associate($type);
		}
		else
		{
			throw new Exception(
				sprintf(
					'Cannot find type %s in system.',
					array_get($meta, 'Type', 'article')
				)
			);
		}

		$author = $this->users
		    ->where('username', 'like', array_get($meta, 'Author'))
		    ->orWhere('first_name', 'like', array_get($meta, 'Author'))
		    ->get();

		if ($author->count() > 0)
		{
			$post->author()->associate($author);
		}
		else
		{
			throw new Exception(
				sprintf(
					'Cannot find author with username or First Name of %s in system.',
					array_get($meta, 'Author')
				)
			);
		}

		if ($post->save())
		{
		}
		else
		{
			dd($post->getErrors());
		}
	}

}