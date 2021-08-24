import { InputLabel, MenuItem, Select } from "@material-ui/core";
import { Title } from "@material-ui/icons";
import React from "react";
import styleSelect from "./style";

export default function FormRecord(props) {

   const classes = styleSelect();

    return  <div className={props.className}>
                <InputLabel className={classes.label} id="demo-simple-select-label">{props.label}</InputLabel>
                <Select
                    className={classes.root}
                    labelId="demo-simple-select-label"
                    id="demo-simple-select"
                    value={props.value}
                    name={props.name}
                    onChange={props.onChange}
                >
                {props.children.map(item => item)}
                </Select>
            </div>
}


