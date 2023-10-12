import React, { useEffect, useState } from 'react'
import Layout from '../../components/Layout/Layout'

import Input from '../../components/ui/Input/Input'
import Button from '../../components/ui/Button/Button'
import styles from './Login.module.css'
import Error from '../../components/ui/Error/Error'

import axios from 'axios'
import { redirect, useNavigate } from 'react-router-dom'
import { useAuth } from '../../hooks/useAuth'

const Login = () => {
   const [username, setUsername] = useState('')
   const [password, setPassword] = useState('')
   const [error, setError] = useState('')

   const {setIsAuth, isAuth} = useAuth()

   useEffect(()  => {
      if (isAuth) {
         navigate('/')
      }
      document.title = 'Login'
   }, [])

   const navigate = useNavigate()

   const login = async  (e) => {
      e.preventDefault()
      console.log(username, password)

      axios.post('http://127.0.0.1:8000/api/login', 
         {username: username, 
         password: password}
      ).then(res => {
         localStorage.setItem('Blitzo&Stolas', res.data.token)
         setIsAuth(true)

         navigate('/XX/alatech/')
         window.location.reload()
         
      }).catch(err => {
         setError(err.response.data.message)
      })
   }

  return (
    <Layout>
      <form action="" className={styles.form}>
         <h2>Login</h2>
            <input 
               type="text" 
               placeholder='Enter your username'
               onChange={e => setUsername(e.target.value)}
               value={username}
            />
            <input 
               type="password" 
               placeholder='Enter your password'
               onChange={e => setPassword(e.target.value)}
               value={password}
            />
           { error? (
            <div className={styles.error}>{error}</div>
         ): <></>}
         <Button onClick={login}>Continue</Button>
      </form>
    </Layout>
  )
}

export default Login