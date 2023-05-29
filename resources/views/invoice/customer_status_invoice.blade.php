<html>
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		<link rel="stylesheet" href="style.css">
		<link rel="license" href="https://www.opensource.org/licenses/mit-license/">
		<script src="script.js"></script>
	</head>
    <style>
*{
	border: 0;
	box-sizing: content-box;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
	font-style: inherit;
	font-weight: inherit;
	line-height: inherit;
	list-style: none;
	margin: 0;
	padding: 0;
	text-decoration: none;
	vertical-align: top;
}

/* content editable */

*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

*[contenteditable] { cursor: pointer; }

*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

span[contenteditable] { display: inline-block; }

/* heading */

h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

/* table */

table { font-size: 75%; table-layout: fixed; width: 100%; }
table { border-collapse: separate; border-spacing: 2px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }

/* page */

html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
html { background: #999; cursor: default; }

body { box-sizing: border-box; height: 10.5in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 7.5in; }
body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

/* header */

header { margin: 0 0 3em; }
header:after { clear: both; content: ""; display: table; }

header h1 { background: #98e4ff; border-radius: 0.25em; color: #000; margin: 0 0 1em; padding: 0.5em 0; }
header address { float: right; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
header address p { margin: 0 0 0.25em; }
header span, header img { display: block; float: left; }
header span { margin: 10px 0 0em 0em; max-height: 25%; max-width: 60%; position: relative; }
header img { max-height: 100%; max-width: 100%; }
header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

/* article */

article, article address, table.meta, table.inventory { margin: 0 0 3em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: right; font-size: 125%; font-weight: bold; }

/* table meta & balance */

table.meta, table.balance { float: right; width: 36%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */



/* table items */

table.inventory { clear: both; width: 100%; }
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) { text-align: right; width: 12%; }
table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }

/* table balance */

table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }

/* aside */

aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }
header h2{
    font-size: 20px;
    font-weight: 700;
    padding-bottom: 10px;
   
}
header h5{
    font-size: 18px;
    font-weight: 900;
}




@media print {
	* { -webkit-print-color-adjust: exact; }
	html { background: none; padding: 0; }
	body { box-shadow: none; margin: 0; }
	span:empty { display: none; }
	.add, .cut { display: none; }
}

@page { margin: 0; }
    </style>
<body>
    <header>
        
        <h1>Invoice</h1>
        <h5>Nia Gallery BD</h5>
        
        <span><img alt="" src="https://i.ibb.co/KwvXRkF/logo.png"></span>
        <address>
            <h2>Nia Gallery BD</h2>
            <p>Street: Uttar Badda-1212 <br>Dhaka</p>
            <p>Phone: (800) 555-1234</p>
            <p>Email Address: Abd@gmail.com</p>
        </address>
        
    </header>
    <article>
       
        <table style="margin-bottom: 20px;">
            <tr>
                <th style="background: #98e4ff;"><span>Invoice #</span></th>
                <td><span>{{App\Models\Billing::where('order_id',$order_id)->first()->created_at->format('dmy')}}.{{$order_id}}</span></td>
            </tr>
            <tr>
                <th style="background: #98e4ff;"><span>Date</span></th>
                <td><span>{{App\Models\Billing::where('order_id',$order_id)->first()->created_at->format('d M Y')}}</span></td>
            </tr>
            <tr>
                <th style="background: #98e4ff;"><span>Amount Due</span></th>
                <td>TK <span>{{App\Models\Order::where('id',$order_id)->first()->total}}</span></td>
            </tr>
        </table>
        <table  style="margin-bottom: 20px;">
            <tr>
                <th style="text-align: center;font-size:25px;font-weight:700;background: #98e4ff;" colspan="2">Billing Info</th>
            </tr>
            <tr>
                <th style="background: #98e4ff;"><span>Name</span></th>
                <td><span>{{App\Models\Billing::where('order_id',$order_id)->first()->name}}</span></td>
            </tr>
            <tr>
                <th style="background: #98e4ff;"><span>Address</span></th>
                <td><span>{{App\Models\Billing::where('order_id',$order_id)->first()->address}},{{App\Models\Billing::where('order_id',$order_id)->first()->rel_to_city->name}}</span></td>
            </tr>
            <tr>
                <th style="background: #98e4ff;"><span>Phone</span></th>
                <td><span>{{App\Models\Billing::where('order_id',$order_id)->first()->mobile}}</span></td>
            </tr>
            <tr>
                <th style="background: #98e4ff;"><span>Email Address</span></th>
                <td><span>{{App\Models\Billing::where('order_id',$order_id)->first()->email}}</span></td>
            </tr>
        </table>
        <table>
            <thead>
                <tr>
                    <th style="background: #98e4ff;text-align: center; border: none;"><span>SL NO:</span></th>
                    <th style="background: #98e4ff;text-align: center;"><span>Item</span></th>
                    <th style="background: #98e4ff;text-align: center;"><span>Quantity</span></th>
                    <th style="background: #98e4ff;text-align: center;"><span>Price</span></th>
                </tr>
            </thead>
            <tbody>
               @foreach (App\Models\OrderProduct::where('order_id',$order_id)->get() as $product)
                <tr>
                    <td style="text-align: center;"><span >{{$product->order_id}}</span></td>
                    <td style="text-align: center;"><span >{{$product->rel_to_product->product_name}}</span></td>
                    <td style="text-align: center;"><span >{{$product->quantity}}</span></td>
                    <td style="text-align: center;">TK <span>{{$product->price}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
       
        <table class="balance" style="margin-top: 15px;">
            <tr>
                <th style="background: #98e4ff;"><span>Sub Total</span></th>
                <td>TK <span>{{App\Models\Order::where('id',$order_id)->first()->subtotal}}</span></td>
            </tr>
            <tr>
                <th style="background: #98e4ff;"><span>Discount</span></th>
                <td>TK <span>{{App\Models\Order::where('id',$order_id)->first()->discount}}</span></td>
            </tr>
            <tr>
                <th style="background: #98e4ff;"><span>Delivery Charge</span></th>
                <td>TK <span>{{App\Models\Order::where('id',$order_id)->first()->delivery}}</span></td>
            </tr>
            <tr>
                <th style="background: #98e4ff;"><span>Total</span></th>
                <td>TK <span>{{App\Models\Order::where('id',$order_id)->first()->total}}</span></td>
            </tr>
        </table>
       
    </article>
    <aside>
        <h1><span>Additional Notes</span></h1>
        <div>
            <p>Thank you for your Order here. I hope you will Enjoy Our service.</p>
        </div>
    </aside>
</body>
</html>