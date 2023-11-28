<x-app-layout>
    <div class="mt-3 p-3 rounded bg-white">
        <div class="d-flex align-items-center">
            <svg class="mr-2" height="24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path
                    d="M208 64a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zM9.8 214.8c5.1-12.2 19.1-18 31.4-12.9L60.7 210l22.9-38.1C99.9 144.6 129.3 128 161 128c51.4 0 97 32.9 113.3 81.7l34.6 103.7 79.3 33.1 34.2-45.6c6.4-8.5 16.6-13.3 27.2-12.8s20.3 6.4 25.8 15.5l96 160c5.9 9.9 6.1 22.2 .4 32.2s-16.3 16.2-27.8 16.2H288c-11.1 0-21.4-5.7-27.2-15.2s-6.4-21.2-1.4-31.1l16-32c5.4-10.8 16.5-17.7 28.6-17.7h32l22.5-30L22.8 246.2c-12.2-5.1-18-19.1-12.9-31.4zm82.8 91.8l112 48c11.8 5 19.4 16.6 19.4 29.4v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V405.1l-60.6-26-37 111c-5.6 16.8-23.7 25.8-40.5 20.2S-3.9 486.6 1.6 469.9l48-144 11-33 32 13.7z" />
            </svg>
            <h1 class="h4 mb-0">{{ $project->title }}</h1>
        </div>
        <p class="mt-2 mb-0 text-muted">Requesting Company: {{ $project->company->name }}</p>
        <p class="mt-2 mb-0">
            Status:
            @if ($project->status == 'ongoing')
                <span class="text-warning">Ongoing</span>
            @elseif ($project->status == 'completed')
                <span class="text-success">Completed</span>
            @endif
        </p>
    </div>

    <div class="mt-3 p-3 rounded bg-white">
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="h5 mb-0">Documents</h1>

            <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal"
                data-target="#uploadDocumentModal">
                <svg class="feather" fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="1em"
                    viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                    <path
                        d="M288 109.3V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3l-73.4 73.4c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l128-128c12.5-12.5 32.8-12.5 45.3 0l128 128c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L288 109.3zM64 352H192c0 35.3 28.7 64 64 64s64-28.7 64-64H448c35.3 0 64 28.7 64 64v32c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V416c0-35.3 28.7-64 64-64zM432 456a24 24 0 1 0 0-48 24 24 0 1 0 0 48z" />
                </svg>
                Upload Documents
            </button>
        </div>

        <div class="modal fade" id="uploadDocumentModal" tabindex="-1" aria-labelledby="uploadDocumentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadDocumentModalLabel">Upload Document</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('projects.documents.store', $project) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div>
                                <div class="custom-file">
                                    <input type="file" name="document" id="document" class="custom-file-input"
                                        accept="application/pdf">
                                    <label class="custom-file-label" for="document">Choose file</label>
                                </div>
                            </div>

                            <div class="mt-3 text-right">
                                <button type="button" class="btn btn-sm btn-secondary"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3 p-3 rounded bg-white">
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="h5 mb-0">Bidding Status</h1>

            <form action="" method="post">
                @csrf
                <button type="submit" class="btn btn-sm btn-success">
                    <svg class="feather" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c-7.6 4.2-12.3 12.3-12.3 20.9V344c0 8.7 4.7 16.7 12.3 20.9s16.8 4.1 24.3-.5l144-88c7.1-4.4 11.5-12.1 11.5-20.5s-4.4-16.1-11.5-20.5l-144-88c-7.4-4.5-16.7-4.7-24.3-.5z" />
                    </svg>
                    Start Bidding
                </button>
            </form>
        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                <p class="text-muted">First Bidding</p>
                <ul class="list-group">
                    <li class="list-group-item"></li>
                </ul>
            </div>
            <div class="col-md-4">
                <p class="text-muted">Second Bidding</p>
                <ul class="list-group">
                    <li class="list-group-item"></li>
                </ul>
            </div>
            <div class="col-md-4">
                <p class="text-muted">Third Bidding</p>
                <ul class="list-group">
                    <li class="list-group-item"></li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
