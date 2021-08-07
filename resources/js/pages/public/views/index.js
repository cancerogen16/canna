import { Container, Grid } from '@material-ui/core'
import React, { Component } from 'react'
import ListSalon from '../../../components/Public/ListSalon'
import SearchSalon from '../../../components/Public/SearchSalon'

export default function Page() {

    return (
        <Grid container spacing={3}>
            <Grid item xs={9}>
                <ListSalon/>
            </Grid>
            <Grid item xs={3}>
                <SearchSalon/>
            </Grid>
        </Grid>)
}