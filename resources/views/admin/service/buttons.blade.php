<div class="btn-group" style="display: flex; justify-content: center">
    <a href="{{ route('admin.service.edit', $service->id) }}" class="btn btn-success"> Edit </a>
    <a class="clickDeleteFunction btn btn-danger" style="cursor: pointer;" data-modal="deleteEventModal" data-action="{{ route('admin.service.delete', $service->id) }}">Delete</a>
</div>