<table>
    <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Options</th>
    </tr>
    [%foreach from=$struct key=k item=element%]
        <tr>
            <td>
                [% $element.name %]
            </td>
            <td>
                [% $element.description %]    
            </td>
            <td>
                <a href="[% $k %]/">Modifier</a>
            </td>
        </tr>
    [%/foreach%]
    <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Options</th>
    </tr>    
</table>    
