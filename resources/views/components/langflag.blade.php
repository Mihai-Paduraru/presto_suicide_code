<form action="{{route('locale', $lang)}}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="flag-button"><span class="flag-icon flag-icon-{{$nation}}"></span></button>
</form>