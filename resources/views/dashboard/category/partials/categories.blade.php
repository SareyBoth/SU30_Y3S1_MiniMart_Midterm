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
        $statusStyle = 'color: green;';
        } elseif (strtolower($statusName) === 'inactive') {
        $statusStyle = 'color: red;';
        }
        @endphp
        <p class="text-4" style="{{ $statusStyle }}">
            {{ $statusName }}
        </p>
        <div class="user-country">{{ $category->description }}</div>
    </div>
</div>
{{-- Delete Confirmation Modal --}}
<div id="delete_doctor" class="modal fade delete-modal" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3>Are you sure you want to delete this Category?</h3>
                <div class="m-t-20">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <form action="{{ route('dashboard.category.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-white" style="color:#dc3545; cursor:pointer;">
                            Delete
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endforeach