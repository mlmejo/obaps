<x-app-layout>
    <div class="d-flex mt-3 p-3 align-items-center justify-content-between rounded bg-white">
        <div class="d-flex align-items-center">
            <svg class="mr-2" height="24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path
                    d="M48 0C21.5 0 0 21.5 0 48V464c0 26.5 21.5 48 48 48h96V432c0-26.5 21.5-48 48-48s48 21.5 48 48v80h96c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48H48zM64 240c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V240zm112-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H176c-8.8 0-16-7.2-16-16V240c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H272c-8.8 0-16-7.2-16-16V240zM80 96h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16zm80 16c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H176c-8.8 0-16-7.2-16-16V112zM272 96h32c8.8 0 16 7.2 16 16v32c0 8.8-7.2 16-16 16H272c-8.8 0-16-7.2-16-16V112c0-8.8 7.2-16 16-16z" />
            </svg>
            <h1 class="h4 mb-0">Company Profile</h1>
        </div>
    </div>

    <div class="mt-3 p-3 bg-white">
        <h1 class="h5">Company name: {{ $company->name }}</h1>

        <p class="text-muted">BAC Committee</p>
        <button type="submit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newCommitteeModal">
            <svg class="feather" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path
                    d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
            </svg>
            New Staff
        </button>

        <div class="table-responsive mt-3">
            <table class="table">
                <tr>
                    <th>Chairman:</th>
                    @if ($chairman = $company->committee->where('position', 'chairman')->first())
                        <td class="w-100">{{ $chairman->name }}</td>
                    @else
                        <td></td>
                    @endif
                </tr>
                <tr>
                    <th class="text-nowrap">Vice Chairman:</th>
                    @if ($vice_chairman = $company->committee->where('position', 'vice_chairman')->first())
                        <td class="w-100">{{ $vice_chairman->name }}</td>
                    @else
                        <td></td>
                    @endif
                </tr>
                <tr>
                    <th>Treasurer:</th>
                    @if ($treasurer = $company->committee->where('position', 'treasurer')->first())
                        <td class="w-100">{{ $treasurer->name }}</td>
                    @else
                        <td></td>
                    @endif
                </tr>
                <tr>
                    <th>Secretary:</th>
                    @if ($secretary = $company->committee->where('position', 'secretary')->first())
                        <td class="w-100">{{ $secretary->name }}</td>
                    @else
                        <td></td>
                    @endif
                </tr>
                <tr>
                    <th>Member:</th>
                    @php
                        $members = $company
                            ->committee()
                            ->where('position', 'member')
                            ->get();
                    @endphp

                    @if ($members->count() > 0)
                        <td class="w-100">{{ $members[0]->name }}</td>
                    @else
                        <td></td>
                    @endif
                </tr>

                @if ($members->count() > 1)
                    @foreach ($members->skip(1) as $member)
                        <tr>
                            <th></th>
                            <td>{{ $member->name }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>

        <div class="modal fade" id="newCommitteeModal" tabindex="-1" aria-labelledby="newCommitteeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newCommitteeModalLabel">New BAC Staff</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('companies.committee.store', $company) }}" method="post">
                            @csrf

                            <div>
                                <label for="name" class="form-label">Staff Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="mt-3">
                                <label for="position" class="form-label">Position</label>
                                <select name="position" id="position" class="custom-select">
                                    <option value="">Select option</option>
                                    <option value="chairman">Chairman</option>
                                    <option value="vice_chairman">Vice Chairman</option>
                                    <option value="treasurer">Treasurer</option>
                                    <option value="secretary">Secretary</option>
                                    <option value="member">Member</option>
                                </select>
                            </div>
                            <div class="mt-3 text-right">
                                <button type="button" class="btn btn-sm btn-secondary"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-3 p-3 bg-white">
        <h1 class="h5 mb-3">Projects</h1>
        <a role="button" href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newBidModal">
            <svg class="feather" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path
                    d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
            </svg>
            Initiate New Bid
        </a>

        <div class="table-responsive mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>Ongoing</th>
                        <th>Completed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($company->projects as $project)
                        <tr>
                            @if ($project->status === 'ongoing')
                                <td>
                                    <a href="{{ route('companies.projects.show', [$company, $project]) }}">
                                        {{ $project->title }}
                                    </a>
                                </td>
                                <td></td>
                            @elseif ($project->status === 'completed')
                                <td></td>
                                <td>
                                    <a href="{{ route('companies.projects.show', [$company, $project]) }}">
                                        {{ $project->title }}
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="newBidModal" tabindex="-1" aria-labelledby="newBidModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newBidModalLabel">Initiate New Bid</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('companies.projects.store', $company) }}" method="post">
                            @csrf
                            <div>
                                <label for="title" class="form-label">Project title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <div class="mt-3 text-right">
                                <button type="button" class="btn btn-sm btn-secondary"
                                    data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-sm btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
