@props(['colonnes' => []])

<thead class="bg-dark text-left text-white">
    <tr>
        @foreach ($colonnes as $colonne)
            <th>{{ $colonne }}</th>
        @endforeach
    </tr>
</thead>