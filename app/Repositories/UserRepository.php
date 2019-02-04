<?php

namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Str;

class UserRepository extends Repository
{
	/**
	 * Specify Model class name
	 *
	 * @return mixed
	 */
	function model()
	{
		return User::class;
	}

	public function createUser($data)
	{
		$user = [
			'login' => $data['email'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'firstName' => $data['firstName'],
			'lastName' => $data['lastName'],
			'phone' => $data['phone'],
			'country_id' => $data['country_id'] ?? '',
			'city' => $data['city'] ?? '',
			'street' => $data['street'] ?? '',
			'houseNumber' => $data['houseNumber'] ?? ''
		];
		$user = $this->create($user);
		return $user;
	}

	public function editUser($data, $user) {
		$array = [
			'login' => $data['login'] ?? $data['email'],
			'email' => $data['email'],
			'firstName' => $data['firstName'],
			'lastName' => $data['lastName'],
			'phone' => $data['phone'],
			'country_id' => $data['country_id'] ?? '',
			'city' => $data['city'] ?? '',
			'street' => $data['street'] ?? '',
			'houseNumber' => $data['houseNumber'] ?? ''
		];

        if(isset($data['password'])) {
            if(\Hash::check($data['password'], $user->password)) {
                $array['password'] = bcrypt($data['password_new']);
            }
            else {
                return 'incorrect_password';
            }
        }

		$this->update($array, ['id' => $user->id]);

		return true;
	}

    public function createDistributor($data)
    {
        $userUnique = Str::random(8);
        $user = [
            'login' => $userUnique,
            'email' => $data['email'] ?? $userUnique,
            'password' => bcrypt($userUnique),
            'firstName' => $userUnique,
            'lastName' => $data['title'],
            'phone' => $data['phone'] ?? rand(1000, 10000),
        ];
        $user = $this->create($user);

        $user->assignRole('distributor');

        return $user;
    }
}
