<h3>Liste des contenus</h3>
[%foreach from=$typeList key=k item=type%]
    [%if $type.locked == "false" %]
        <br /><h4>[%$type.name%]</h4>
        <table>
            <tr>
            [%foreach from=$type.index key=kI item=dataI%]
                <th>[%$dataI%]</th>
            [%/foreach%]
            </tr>

            [%foreach from=$type.data key=k2 item=dataL%]
            <tr>
                [%foreach from=$dataL key=k3 item=dataLI%]
                    [%if in_array($k3, $type.index)%]
                        <td>[% $k3 %] [%$dataLI%]</td>
                    [%/if%]
                [%/foreach%]
            </tr>
            [%/foreach%]
        </table>
        <a href="ajouter/[%$k%]/#[%$type.name%]">Nouveau [%$type.name%]</a><br /><br />
    [%/if%]
[%/foreach%]