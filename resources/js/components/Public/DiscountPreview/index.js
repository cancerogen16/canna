import {Avatar} from '@material-ui/core'
import discountPreview from './style';
import React from 'react'

export default function DiscountPreview(props) {

    const {action} = props;
    const classes = discountPreview();
    return <>

        <div className={classes.root}>
            <Avatar className={classes.ava} alt={action.name} src={action.photo}/>
            <div className={classes.info}>
                <span className={classes.name}>{action.name}</span>
                <span className={classes.spec}>{action.position}</span>
            </div>
            <div>
                <p> {action.end_at} ч.</p>
            </div>
        </div>
        <div className={classes.btns}>
            {props.children}
        </div>
    </>

}