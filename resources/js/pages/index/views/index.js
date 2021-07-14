import { Container, Grid } from '@material-ui/core'
import React, { Component } from 'react'
import ListSalon from '../../../components/ListSalon/inde'
import SearchSalon from '../../../components/search-salon'
export default function Page() {

    return (<Container maxWidth="lg">
        <Grid container spacing={3}>
            <Grid item xs={9}>
                <ListSalon/>
            </Grid>
            <Grid item xs={3}>
                <SearchSalon/>
            </Grid>
        </Grid>
    </Container>)
}