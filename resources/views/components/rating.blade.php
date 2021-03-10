<div>
    <!-- Modal -->
    <div class="modal fade" id="rating" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Following</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container row align-items-baseline mx-auto">
                        @foreach ($profiles as $profile)
                            <div class="col-2">
                                <img src="{{ $profile->profileImage() }}" class="rounded-circle" width="50px"
                                    height="50px">
                            </div>
                            <div class="col-6">
                                <div class="link-web h5"><a
                                        href="{{ route('profile.index', $profile->user) }}">{{ $profile->user->name }}</a>
                                </div>
                                <div class="text-muted h5">{{ $profile->title }}</div>
                            </div>
                            <input type="hidden"
                                value="{{ $follows = auth()->user()
    ? auth()->user()->following->contains($profile->user->id)
    : false }}">
                            <div class="col-2">
                                @if ($profile->user->id == Auth::user()->id)
                                @else
                                    <follow-button user-id="{{ $profile->user->id }}" follows="{{ $follows }}">
                                    </follow-button>
                                @endif

                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>
</div>
