@php $editing = isset($channel) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $channel->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="icon"
            label="Icon"
            :value="old('icon', ($editing ? $channel->icon : ''))"
            maxlength="255"
            placeholder="Icon"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="configuration"
            label="Configuration"
            maxlength="255"
            required
            >{{ old('configuration', ($editing ?
            json_encode($channel->configuration) : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="status"
            label="Status"
            :checked="old('status', ($editing ? $channel->status : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
