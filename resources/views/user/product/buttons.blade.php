<div class="btn-group" style="display: flex; justify-content: center">
    <a href="{{ route('user.product.edit', $product->id) }}" class="btn btn-success"> Edit </a>
    <a class="clickDeleteFunction btn btn-danger" style="cursor: pointer;" data-modal="deleteEventModal" data-action="{{ route('user.product.delete', $product->id) }}">Delete</a>
</div>