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
	}

}