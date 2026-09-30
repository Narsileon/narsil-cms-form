<x-narsil::blocks.combobox.combobox-root
	:fetch-route="'forms.search'"
	:id="$id"
	:min-search-length="3"
	:name="$name"
	:options="$options"
	:placeholder="$placeholder"
	:required="$required"
	:value="$value"
	{{ $attributes->twMerge() }}
/>
