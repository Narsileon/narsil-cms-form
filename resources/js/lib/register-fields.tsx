import { registerField } from "@narsil-ui/components/form/inputs";
import { dynamic } from "@narsil-ui/lib/dynamic";

const AsyncCombobox = dynamic(() => import("@narsil-ui/components/combobox/aync-combobox"));

export function registerFields() {
  registerField("form", (props) => {
    return (
      <AsyncCombobox
        {...props.input}
        id={props.id}
        fetchRoute="forms.search"
        required={props.required}
        value={props.value}
        valuePath={props.input.valuePath ?? "identifier"}
        setValue={props.setValue}
      />
    );
  });
}
