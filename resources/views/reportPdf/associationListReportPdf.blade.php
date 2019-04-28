<style>
    p{
        line-height: 0.20;
        font-size: 15px;
    }
</style>

<div style="margin-bottom: 15px;text-align: center;">
    <p>Association List</p>
</div><!-- /.row -->


<table width="700px" border="1"  style="font-size: 12px; text-align: center;border-collapse: collapse;">
    <tr>
        <td class="fixedWidth"> {{ trans('dashboard.sl') }}</td>
        <td>Association List</td>
        <td>Zone Name</td>

    </tr>
    <?php $sl = 0; ?>

    @foreach($asociationLists as $asociationList)
        <tr>
            <td>{{ ++$sl }}</td>
            <td>{{$asociationList->ASSOCIATION_NAME}}</td>
            <td>{{$asociationList->ZONE_NAME}}</td>

        </tr>
    @endforeach

</table>