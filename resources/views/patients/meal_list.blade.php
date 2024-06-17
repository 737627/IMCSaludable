<div>
    <ul>
        @foreach($diets as $diet)
            @if($diet->meal_type == $mealType)
                <li>{{ $diet->name }}</li>
            @endif
        @endforeach
    </ul>
</div>
