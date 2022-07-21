<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('css/custom.css') }}>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
        rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>



    <title>Billing App</title>
</head>

<body>

    <h3 class="mt-3 mx-5 text-primary">Input Form
    </h3>
    <hr>



    <div class="container ">

        

        <div class="row">

            <div class="col-md-4 col-4 mt-5">
                <input type="text" id="searchBill" class=" form-control" aria-describedby="sizing-addon1"
                    placeholder="Bill No">
            </div>

            <div class="col-md-4 col-4 mt-5 ">
                <button type="button" onclick="searchBill()" class=" btn btn-primary ">Find</button>
            </div>
           


        </div>
    </div>


    <?php
$customers = App\Models\Customers::latest()->get();
$products = App\Models\Products::latest()->get();

?>
    <input type="hidden" id="qty" value="1">
    <input type="hidden" id="discount" value="0">


    <div class="container ">
        <div class="row">


            

            <div class="col-md-4 col-4 mt-4">
                <select id="pid" class="  custom-select mt-2">
                    <option id="pid" value="" selected="" disabled="">Add Product Or Items</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 col-4 mt-4">
                <select id="cid" class="   mt-2 custom-select">
                    <option id="cid" value="" selected="" disabled="">Select a Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>


        </div >
        <div class="row">
            <div class="col-md-3 col-3 mt-4">
                <input type="text" id="date1" class="date form-control" aria-describedby="sizing-addon1"
                    placeholder="Date">
            </div>
            <div class="col-md-3 col-3 mt-4">
                <input type="text" id="paidAmount" class=" form-control" aria-describedby="sizing-addon1"
                    placeholder="Paid Amount">
            </div>
            <div class="col-md-3 col-3 mt-4">
                <input type="text" id="gbill" class=" form-control" aria-describedby="sizing-addon1"
                    placeholder="Enter Bill No">
            </div>
            <div class="col-md-3 col-3 mt-4">
                <button type="button" onclick="addData2()" class="btn btn-primary ">ADD</button>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <table id="Mytable" class="table table-bordered  mt-5 ">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Net Amount</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- <tr>

<td>rice</td>
<td>60</td>
<td>
    <input type="text" class="qty" id="qty" value="10">
</td>
<td>600</td>
<td>
    <input type="text" class="discount" id="discount" value="0">
</td>
<td>590</td>
</tr> --}}
                </tbody>
            </table>
        </div>
    </div>


    <div class="container">
        <div class="row  mt-4 ">
            <div class="col-md-8 col-4 ">
                <span class="font-weight-bold "></span>
            </div>
            <div class="col-md-2 col-2 ">
                <span class="font-weight-bold ">Net Total </span>
            </div>
            <div class="col-md-2 col-2 cust">
                <span class="font-weight-bold netTotal"> </span>
            </div>
            
        </div>

        <div class="row  mt-4 ">
            <div class="col-md-8 col-4 ">
                <span class="font-weight-bold "></span>
            </div>
            <div class="col-md-2 col-2 ">
                <span class="font-weight-bold ">Discount Total </span>
            </div>
            <div class="col-md-2 col-2 cust">
                <span class="font-weight-bold discountTotal"> </span>
            </div>
            
        </div>

        <div class="row  mt-4 ">
            <div class="col-md-8 col-4 ">
                <span class="font-weight-bold "></span>
            </div>
            <div class="col-md-2 col-2 ">
                <span class="font-weight-bold ">Paid Amount </span>
            </div>
            <div class="col-md-2 col-2 cust">
                <span class="font-weight-bold paidAmount"> </span>
            </div>
            
        </div>

        <div class="row  mt-4 ">
            <div class="col-md-8 col-4 ">
                <span class="font-weight-bold "></span>
            </div>
            <div class="col-md-2 col-2 ">
                <span class="font-weight-bold ">Due Amount </span>
            </div>
            <div class="col-md-2 col-2 cust">
                <span class="font-weight-bold dueAmount"> </span>
            </div>
            
        </div>

        <div class="row  mt-4 ">
            <div class="col-md-9 col-4 ">
                <span class="font-weight-bold "></span>
            </div>
            
            <div class="col-md-3 col-3  ">
                {{-- <button type="button" onclick="saveChange()" class="btn btn-primary  ">SAVE CHANGE</button> --}}
                <button type="button" onclick="billSave()" class="btn btn-primary ">ADD</button>
            </div>
            
        </div>
        
    </div>
    <br><br><br>


    <script type="text/javascript">
        $('.date').datepicker({
            format: 'mm-dd-yyyy'
        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>



    <script>
        function ShowData() {

            $.ajax({
                type: 'get',
                dataType: 'json',
                url: '/show',
                success: function (response) {
                    $.each(response, function (key, value) {
                        console.log('v2 ' + value.id);
                        // $('.netTotal').text( value.netTotal );
                        // $('.discountTotal').text( value.discountTotal );
                        // $('.paidAmount').text( value.paidAmount );
                        // $('.dueAmount').text( value.dueAmount );
                    })

                    var data = '';

                    $.each(response, function (key, value) {

                        data = data + "<tr>"
                        data = data + "<td>" + value.name + "</td>"
                        data = data + "<td>" + value.rate + "</td>"
                        data = data + "<td>"
                        data = data + "<input type='text' class='updateQty'  onchange='qtyData(" +
                            value.id + ")' id='qty1' value=" + value.qty + ">"
                        data = data + "</td>"

                        data = data + "<td>" + value.totalAmount + "</td>"

                        data = data + "<td>"
                        // <input type="text" class="qty" id="qty" value="10">
                        data = data + "<input type='text' class='updateDis' onchange='editData(" +
                            value.id + ")' id='discount1' value=" + value.discount + ">"

                        data = data + "</td>"
                        data = data + "<td>" + value.netAmount + "</td>"
                        data = data + "</tr>"
                    })
                    $('tbody').html(data);

                }
            })
        }
        
        

        function addData2() {
            var date = $('#date1').val();
            var productId = $('#pid').val();
            var customerId = $('#cid').val();
            var billNo = $('#gbill').val();
            var qty = $('#qty').val();
            var discount = $('#discount').val();
            var paidAmount = $('#paidAmount').val();

            $.ajax({
                type: 'post',
                dataType: 'json',
                data: {
                    productId: productId,
                    customerId: customerId,
                    date: date,
                    qty: qty,
                    discount: discount,
                    paidAmount: paidAmount,
                    billNo:billNo,

                },
                url: '/store',
                success: function (data) {
                    ShowData()
                    console.log(data);
                }
            })


        }
        ShowData()
        

        function qtyData(id) {

            $(document).on('change', '.updateQty', function (e) {
                e.preventDefault();
                let qty = $(this).val()
                console.log(qty);


                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    data: {

                        qty: qty,

                    },
                    url: '/qty/' + id,
                    success: function (response) {
                        ShowData()
                        console.log(response);
                    }
                })

            })
        }


        function editData(id) {

            $(document).on('change', '.updateDis', function (e) {
                e.preventDefault();
                let discount = $(this).val()
                console.log(discount);

                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    data: {
                        discount: discount,
                    },
                    url: '/edit/' + id,
                    success: function (response) {
                        ShowData()
                        console.log(response);


                    }
                })

            })
        }





function searchBill(){
    var billNo = $('#searchBill').val();
                console.log(billNo);

                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    data: {
                        billNo: billNo,
                    },
                    url: '/bill',
                    success: function (response) {
                        
                        console.log(response);
                        


                        var data = '';
                        var sum1=0,sum2=0,sum3=0,sum4=0;
$.each(response, function (key, value) {
    var iNum1 = parseInt(value.netTotal);
    var iNum2 = parseInt(value.discountTotal);
    var iNum3 = parseInt(value.paidAmount);
    var iNum4 = parseInt(value.dueAmount);
     sum1 = sum1+iNum1;
     sum2 = sum2+iNum2;
     sum3 = sum3+iNum3;
     sum4 = sum4+iNum4;

    

    data = data + "<tr>"
        // data = data + "<td type='hidden' id='pdid'>" + value.id  + "</td>"
        // data = data + "<td type='hidden' id='cid'>" + value.customerId  + "</td>"
        // data = data + "<td type='hidden' id='pid'>" + value.productId  + "</td>"
    data = data + "<td>" + value.name + "</td>"
    data = data + "<td>" + value.rate + "</td>"
    data = data + "<td>"
    data = data + "<input type='text' class='updateQty'  onchange='qtyData(" +
        value.id + ")' id='qty1' value=" + value.qty + ">"
    data = data + "</td>"

    data = data + "<td>" + value.totalAmount + "</td>"

    data = data + "<td>"
    // <input type="text" class="qty" id="qty" value="10">
    data = data + "<input type='text' class='updateDis' onchange='editData(" +
        value.id + ")' id='discount1' value=" + value.discount + ">"

    data = data + "</td>"
    data = data + "<td>" + value.netAmount + "</td>"
    data = data + "</tr>"
})
$('tbody').html(data);
$('.netTotal').text( sum1);
    $('.discountTotal').text( sum2 );
    $('.paidAmount').text( sum3 );
    $('.dueAmount').text( sum4);


   
    

    


                    }
                })

}

function billSave() {
            
    var billNo = $('#searchBill').val();
    console.log(billNo)
            $.ajax({
                type: 'post',
                dataType: 'json',
                data: {
                 
                    billNo: billNo,
                    

                },
                url: '/save',
                success: function (data) {
                    
                    console.log(data);
                }
            })


        }











    </script>




















</body>

</html>
