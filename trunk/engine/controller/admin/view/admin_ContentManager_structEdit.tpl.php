<label>Nom</label><input type="text" value="[% $struct.name %]" />
<label>Description</label><textarea>[% $struct.description %]</textarea>

<strong>Elements</strong>
<div>

[%foreach from=$struct.data key=k item=element%]

    <div>
    [% $element.type.name %]

    [%if $element.structId == '1'%]
        <input type="text" name="" value=""/>
    [%/if%]
    [%if $element.structId == '2'%]
        <textarea name="">[% $element.type.name %]</textarea>
    [%/if%]
    [%if $element.structId == '3'%]
        date
    [%/if%]
    [%if $element.structId == '4'%]
        media
    [%/if%]
    </div>
[%/foreach%]
</div>