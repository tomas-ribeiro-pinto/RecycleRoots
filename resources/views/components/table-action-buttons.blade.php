<div class="flex gap-4">
    <x-table-button label="Edit" :url="$row->id" icon="edit" colorClasses="text-r_green-200 hover:text-r_green-100 hover:underline" link="true"/>
    <x-table-button label="Remove" :url="$row->id" icon="remove" colorClasses="text-red-500 hover:text-red-600 hover:underline" link="true"/>
</div>