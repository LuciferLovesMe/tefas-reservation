<td>
    <div class="dropdown">
        <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <svg width="12" height="14" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
            </svg>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ $edit }}">Edit</a></li>
            <li>
                <form action="{{ $destroy }}" id="form-delete-{{ $id }}" method="post" enctype="multipart/form-data">
                @csrf
                    @method('delete')
                    <button class="dropdown-item text-danger btnDelete" data-id="{{ $id }}" type="submit" onclick="deleteRow('form-delete-{{ $id }}')">Hapus</button>
                </form>
            </li>
        </ul>
    </div>
</td>