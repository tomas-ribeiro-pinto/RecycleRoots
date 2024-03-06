<div class="flex gap-4">
    <x-table-button label="See Details" url="{{request()->fullUrl() . '/' . $row->id}}" icon="edit" :link="true" open_new_tab="true" colorClasses="text-r_green-200 hover:text-r_green-100"/>
</div>