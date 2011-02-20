[%if $locked == 'true' && $clone != 'true' %]
    Structure verrouiller
[%else %]

[%if $clone == 'true' %]<h3>Edition d'un clone de [% $struct.name %]</h3>[%/if %]
<form method="post" [%if $clone == 'true' %]action="../"[%/if %] >
    <input type="hidden" name="todo" value="admin[structEdit]" />
    <input type="hidden" name="id" value="[%if $clone != 'true' %][% $structID %][%else %][%/if %]"/>

    
    <label>Nom</label><input name="name" type="text" value="[% $struct.name %][%if $clone == 'true' %] - clone[%/if %]" />
    <label>Description</label><textarea name="description">[% $struct.description %]</textarea>

    <strong>Elements</strong>

    <table id="StructList">

        <tr>
            <th>Label</th>
            <th>ID</th>
            <th>Type</th>
            <th>Valeur(s)</th>
            <th>Limite</th>
            <th>Index</th>
            <th></th>
        </tr>
        

        [%foreach from=$struct.data key=k item=element%]
            <tr>
                <td>
                    <input type="text" name="data[[%$k%]][name]" value="[% $element.type.name %]" />
                </td>
                <td>
                    <input type="text" name="data[[%$k%]][id]" value="[% $element.type.id %]""/>
                </td>
                <td>
                    <select name="data[[%$k%]][type]" onchange="lockLimit()">
                    [%foreach from=$typeList key=kType item=type%]
                        [%if $element.structId == $kType %]
                        <option value="[% $kType %]" selected="selected">[% $type %]</option>
                        [%/if%]
                        [%if $element.structId != $kType %]
                        <option value="[% $kType %]">[% $type %]</option>
                        [%/if%]
                    [%/foreach%]
                    </select>
                </td>
                <td>
                    <input class="valeur" type="text" name="data[[%$k%]][valeur]" value="[% $element.type.valeur %]"/>
                </td>
                <td>
                    <input class="limit" type="text" name="data[[%$k%]][limit]" value="[% $element.type.limit %]" maxlength="3" size="3"/>
                </td>
                <td>
                    <input type="checkbox" name="data[[%$k%]][index]" value="true" [% if $element.type.index =="true" %]checked="checked"[%/if%] />
                </td>
                <td>
                    <a href="#" onclick="deleteElement(this);return false;">x</a>
                </td>
            </tr>
        [%/foreach%]
    </table>


    <input type="button" value="Ajouter un champ" onclick="addElement();"/>

    <br /><br />
    <input type="submit" name="register" value="Enregistrer" /> 

</form>

<table id="elementList" style="display:none;">
    <tr class="elementListAdd" style="display:none;">
        <td>
            <input type="text" nameTmp="data[keyId][name]" />
        </td>
        <td>
            <input type="text" nameTmp="data[keyId][id]" value=""/>
        </td>
        <td>
            <select nameTmp="data[keyId][type]" onchange="lockLimit()">
            [%foreach from=$typeList key=kType item=type%]
                <option value="[% $kType %]">[% $type %]</option>
            [%/foreach%]
            </select>
        </td>
        <td>
            <input class="valeur" type="text" nameTmp="data[keyId][valeur]" value=""/>
        </td>
        <td>
            <input class="limit" type="text" nameTmp="data[keyId][limit]" maxlength="3" size="3" />
        </td>
        <td>
            <a href="#" onclick="deleteElement(this);return false;">x</a>
        </td>        
    </tr>
</table>

<script type="text/javascript">
    var k = "[%$k%]";   // Last keyID
    function addElement(){
        k++;
        ElemenList = $('#elementList tr');
        clone = ElemenList.clone();
        $('#StructList').append(clone);
        $('#StructList').find('tr:last-child').fadeIn();
        $.each($('#StructList').find('tr:last-child').find('input, select'), function(i, item){
            name = $(item).attr('nameTmp').replace("keyId", k);
            $(item).attr('name', name).removeAttr('nameTmp');
        });
    }
    
    function deleteElement(elem){
        $(elem).parents('tr').fadeOut(400, function(){ $(this).remove()});
    }

    function lockLimit(){
        chmpTxt = $('#StructList tr select');
        $.each(chmpTxt, function(i, item){
           e = $(item).parents('tr').find('.limit');
           val = item.value;
           if(val == 10){
            e.removeAttr('disabled');
           }
            else {
            e.val('').attr('disabled', 'disabled');
           }
         });
    }
    lockLimit();
</script>

[%/if %]