<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>List of Item</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <td>Item Type</td>
        <td>Item Name</td>

    </tr>
    <?php $sl = 0; ?>

    @foreach($purchaseSaltList as $purchaseSalt)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$purchaseSalt->LOOKUPCHD_NAME}}</td>
            <td>{{$purchaseSalt->ITEM_NAME}}</td>

        </tr>
    @endforeach

</table>