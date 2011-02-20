<h3>Nouveau contenu [% $struct.name %]</h3>

<form method="post">
    <input type="hidden" name="todo" value="admin[contentEdit]" />
    <input type="hidden" name="collection" value="[% $struct.id %]" />
    [%foreach from=$struct.types key=k item=element%]
    
        <br /><br /><br />
        [%$element.name%]
        [% if $element.limit != '' %](limit :: [%$element.limit%] char)[%/if%]
        <br /><br />

        <!-- Input -->
        [%if $element.refType == '10'%]
            <input name="[%$element.id %]" value="[%$element.valeur %]" [% if $element.limit != '' %]maxlength="[%$element.limit%]"[%/if%]/>
        [%/if %]

        <!-- textarea simple -->
        [%if $element.refType == '20'%]
            <textarea name="[%$element.id %]">[%$element.valeur %]</textarea>
        [%/if %]

        <!-- textarea wysiwyg -->
        [%if $element.refType == '21'%]
            <textarea name="[%$element.id %]" class="wysiwyg">[%$element.valeur %]</textarea>
        [%/if %]

        <!-- date -->
        [%if $element.refType == '30'%]
            <input name="[%$element.id %]" class="date" value="[%$element.valeur %]" />
        [%/if %]

        <!-- media -->
        [%if $element.refType == '40'%]
            // media :: not include
        [%/if %]

        <!-- select -->
        [%if $element.refType == '50'%]
            <select name="[%$element.id %]">
                <option></option>
            </select>
        [%/if %]

    
    [%/foreach%]

    <input type="submit" value="enregistrer" />

</form>