<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <h4>List of Item</h4>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <th>SL</th>
        <th>Item Type</th>
        <th>Item Name</th>
    </tr>
    <?php $sl = 0; ?>

    @foreach($purchaseChemicalLists as $purchaseChemicalList)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$purchaseChemicalList->LOOKUPCHD_NAME}}</td>
            <td>{{$purchaseChemicalList->ITEM_NAME}}</td>

        </tr>
    @endforeach

</table>