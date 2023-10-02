<div class="btn-group" style="display: flex; justify-content: center">
    <a href="{{ route('admin.banner.edit', $banner->id) }}" class="btn btn-success"> Edit </a>
    <a class="clickDeleteFunction btn btn-danger" style="cursor: pointer;" data-modal="deleteEventModal" data-action="{{ route('admin.banner.delete', $banner->id) }}">Delete</a>
</div>