
@if ($errors->any())
<div class="alert alert-danger error">
    <ul >
        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
    </ul>
</div>
@endif