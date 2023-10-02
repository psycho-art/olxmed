<div class="btn-group" style="display: flex; justify-content: center">
    <a href="{{ route('admin.blog.category.edit', $category->id) }}" class="btn btn-success"> Edit </a>
    <a class="clickDeleteFunction btn btn-danger" style="cursor: pointer;" data-modal="deleteEventModal" data-action="{{ route('admin.blog.category.delete', $category->id) }}">Delete</a>
</div>