import { InputLabel, MenuItem, Select } from "@material-ui/core";
import { Title } from "@material-ui/icons";
import React from "react";

export default function FormRecord(props) {

   

    return  <>
                <InputLabel id="demo-simple-select-label">{props.label}</InputLabel>
                <Select
                    labelId="demo-simple-select-label"
                    id="demo-simple-select"
                    value={props.value}
                    name={props.name}
                    onChange={props.onChange}
                >
                {props.children.map(item => item)}
                </Select>
            </>
}


