<table style="text-align: center">
    <thead>
        <tr style="background: black; color: #ffffff;">
            <th>Product name</th>
            <th>Product qantity</th>
            <th>Product price</th>

        </tr>
    </thead>
    <tbody>
    @foreach($orderData as $item)
        <tr>
            <td>{{$item->get_product->ProductName}}</td>
            <td>{{$item->product_quantity}}</td>
            <td>{{$item->product_price}}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td style="font-weight: bold">Discount:</td>
        <td style="font-weight: bold">{{session('discount')}}%</td>
    </tr>
    <tr>
        <td></td>
        <td style="font-weight: bold">Total Price:</td>
        <td style="font-weight: bold">${{session('grand_total')}}</td>
    </tr>
    </tbody>
</table>
