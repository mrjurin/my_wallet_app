{{ csrf_field() }}

<input type="hidden" name="id" value="{{ $model->id }}">

<div class="form-group">
    <label for="">Transaction ID</label>
    <input class="form-control" readonly type="text" name="trans_id" value="{{ $model->trans_id }}">
</div>

<div class="form-group">
    <label for="">Transaction Type</label>
    <select class="form-control" name="transaction_type_id">
        <option value="-">-- SELECT --</option>
        @foreach ($transaction_types as $key=>$value)
            
            <option selected="{{ $model->transaction_type_id == $value }}" value="{{ $value }}">{{ $key }}</option>
        @endforeach
        
    </select>

</div>

<div class="form-group">
    <label for="">Amount</label>
    <input class="form-control" type="text" name="amount" value="{{ $model->amount }}">
</div>

<div class="form-group">
    <label for="">Description</label>
    <input class="form-control" type="text" name="description" value="{{ $model->description }}">
</div>

<div class="form-group">
    <label for="">Receiver</label>
    <select class="form-control" name="receiver">
        <option value="-1">-- SELECT --</option>
        @foreach ($receivers as $key=>$value)
            
            <option selected="{{ $model->receiver == $value }}" value="{{ $value }}">{{ $key }}</option>
        @endforeach
        
    </select>
</div>

<button class="btn btn-primary" type="submit">{{ $button_name }}</button>