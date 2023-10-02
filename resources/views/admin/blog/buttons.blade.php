<div class="btn-group" style="display: flex; justify-content: center">
    <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-success"> Edit </a>
    <a class="clickDeleteFunction btn btn-danger" style="cursor: pointer;" data-modal="deleteEventModal" data-action="{{ route('admin.blog.delete', $blog->id) }}">Delete</a>
</div>