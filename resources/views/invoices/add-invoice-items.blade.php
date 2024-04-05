@if(isset($invoiceItems))
@foreach ( $invoiceItems as $item )

    <div class="row invoice-item">
        <input type="hidden" name="id[]" value="{{ $item->id }}">
        <div class="col-md-2">
            <label for="title">Item Name</label>
            <input type="text" name="name[]" id="name" class="form-control" value="{{ $item->name }}">
        </div>

        <div class="col-md-2">
            <label for="title">Price</label>
            <input type="number" name="price[]" id="price" class="form-control" value="{{ $item->price }}">
        </div>

        <div class="col-md-2">
            <label for="title">Tax</label>
            <input type="number" name="tax[]" id="tax" class="form-control" value="{{ $item->tax }}">
        </div>

        <div class="col-md-2">
            <label for="title">Quantity</label>
            <input type="number" name="quantities[]" id="quantities" class="form-control" value="{{ $item->quantities }}">
        </div>

        <div class="col-md-2">
            <a role="button" class="btn btn-danger mt-4 removeItem">Remove</a>
        </div>

    </div>

    @endforeach

@else


<div class="row invoice-item">
    <div class="col-md-2">
        <label for="title">Item Name</label>
        <input type="text" name="name[]" id="name" class="form-control" value="{{ old('name') }}">
    </div>

    <div class="col-md-2">
        <label for="title">Price</label>
        <input type="number" name="price[]" id="price" class="form-control" value="{{ old('price') }}">
    </div>

    <div class="col-md-2">
        <label for="title">Tax</label>
        <input type="number" name="tax[]" id="tax" class="form-control" value="{{ old('tax') }}">
    </div>

    <div class="col-md-2">
        <label for="title">Quantity</label>
        <input type="number" name="quantities[]" id="quantities" class="form-control" value="{{ old('quantities') }}">
    </div>


    <div class="col-md-2">
        <a role="button" class="btn btn-danger mt-4 removeItem">Remove</a>
    </div>
</div>


@endif
