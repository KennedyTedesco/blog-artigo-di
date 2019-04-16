<?php
declare(strict_types=1);

namespace App\Http\Controller;

use App\Repositories\TagRepository;
use App\Repositories\UserRepository;
use App\Repositories\LeadRepository;

class UserController
{
    protected $tagRepository;
    protected $userRepository;
    protected $leadRepository;

    public function __construct(
        TagRepository $tagRepository,
        UserRepository $userRepository,
        LeadRepository $leadRepository
    ) {
        $this->tagRepository = $tagRepository;
        $this->userRepository = $userRepository;
        $this->leadRepository = $leadRepository;
    }

    public function index() : void
    {
        var_dump(
            $this->tagRepository->findById(1),
            $this->userRepository->findById(2),
            $this->leadRepository->findById(3)
        );
    }
}
