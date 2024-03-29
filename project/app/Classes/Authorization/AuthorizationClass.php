<?php

namespace App\Classes\Authorization;

use Dlnsk\HierarchicalRBAC\Authorization;


/**
 *  This is example of hierarchical RBAC authorization configiration.
 */

class AuthorizationClass extends Authorization
{
	public function getPermissions() {
		return [
			'editPost' => [
					'description' => 'Edit any posts',   // optional property
					'next' => 'editOwnPost',            // used for making chain (hierarchy) of permissions
				],
			'editOwnPost' => [
					'description' => 'Edit own post',
				],

			//---------------
			'delete-post' => [
					'description' => 'Delete any posts',
				],
		];
	}

	public function getRoles() {
		return [
            'admin' => [
                'admin-panel',
                'update-post',
                'delete-post',
            ],
            'professional' => [
					'editPost',
					'deletePost',
				],
			'homeowner' => [
					'editOwnPost',
				],
		];
	}


	/**
	 * Methods which checking permissions.
	 * Methods should be present only if additional checking needs.
	 */

	public function editOwnPost($user, $post) {
		// This is a helper method for getting the model if $post is id
		// $post = $this->getModel(\App\Post::class, $post);

		return $user->id === $post->user_id;
	}

}
