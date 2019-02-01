<tr>
    <td class="ID">{{$plate->id}}</td>
    <td class="Name">{{$plate->name}}</td>
    <td class="description">{{$plate->description}}</td>
    <td class="products">

        <ul>
    @foreach ($plate->products as $product)
        <li>{{$product->name}}</li>
    @endforeach
        </ul>
    </td>
</tr>