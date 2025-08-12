<div>
    <div class="row doctor-grid">
        @foreach ($categories as $category)
        <div class="col-md-4 col-sm-4 col-lg-3">
            <div class="profile-widget">
                <div class="doctor-img">
                    <a class="avatar" href="profile.html">
                        <img alt="" src="/storage/{{ $category->image }}" />
                    </a>
                </div>
                <div class="dropdown profile-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('dashboard.category.edit', $category->id) }}">
                            <i class="fa fa-pencil m-r-5"></i> Edit
                        </a>
                        <a
                            class="dropdown-item"
                            href="#"
                            data-toggle="modal"
                            data-target="#delete_doctor"
                            data-id="{{ $category->id }}">
                            <i class="fa fa-trash-o m-r-5"></i> Delete
                        </a>
                    </div>
                </div>
                <h4 class="doctor-name text-ellipsis"><a href="profile.html">{{ $category->name }}</a></h4>
                @php
                $statusName = $category->statusRelation ? $category->statusRelation->name : 'No Status';
                $statusStyle = '';
                if (strtolower($statusName) === 'active') {
                    $statusStyle = 'color: green;'; // Inline green text
                } elseif (strtolower($statusName) === 'inactive') {
                    $statusStyle = 'color: red;'; // Inline red text
                }
                @endphp

                <p class="text-4" style="{{ $statusStyle }}">
                    {{ $statusName }}
                </p>
                <div class="user-country">{{ $category->description }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="text-center mt-4">
        @if ($categories->hasMorePages())
            <button wire:click="loadMore" class="btn btn-primary px-4 py-2 rounded">
                Load More
            </button>
        @endif
    </div>
</div>
