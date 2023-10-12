import React from 'react'
import Layout from '../../components/Layout/Layout'
import styles from './Error.module.css'

const Error = () => {
  return (
    <Layout>
      <div className={styles.error__page}>
        <h2>404 Error | Page Not Found</h2>
        <br/>
        <a href='/XX/alatech/'>Go To Home Page(/XX/alatech/)</a>
      </div>
    </Layout>
  )
}

export default Error