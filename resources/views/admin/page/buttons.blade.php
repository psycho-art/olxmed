<div class="btn-group" style="display: flex; justify-content: center">
    <a href="{{ route('admin.page.edit', $page->id) }}" class="btn btn-success"> Edit </a>
    <a class="clickDeleteFunction btn btn-danger" style="cursor: pointer;" data-modal="deleteEventModal" data-action="{{ route('admin.page.delete', $page->id) }}">Delete</a>
</div>