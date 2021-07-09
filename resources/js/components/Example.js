import { Grid, Table, TableCell, TableRow } from '@material-ui/core';
import React, { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import {fetchProfileWithThunk} from '../store/profile/action';

export default function Example() {
    const profile = useSelector(store => store.profile)
    const dispatch = useDispatch();
    useEffect(()=>{
        dispatch(fetchProfileWithThunk());
    });
    return (
        <div>
            <Grid container justifyContent="center" alignItems="center" spacing={3}>
                <Grid  item xs={6} >
                    <Table>
                        <TableRow>
                            <TableCell>ФИО</TableCell>
                            <TableCell>{`${profile.firstName} ${profile.lastName}`}</TableCell>
                        </TableRow>
                        <TableRow>
                            <TableCell>E-mail</TableCell>
                            <TableCell>{profile.email}</TableCell>
                        </TableRow>
                        <TableRow>
                            <TableCell>Телефон</TableCell>
                            <TableCell>{profile.phone}</TableCell>
                        </TableRow>
                    </Table>
                </Grid>
            </Grid>
        </div>
    );
}




