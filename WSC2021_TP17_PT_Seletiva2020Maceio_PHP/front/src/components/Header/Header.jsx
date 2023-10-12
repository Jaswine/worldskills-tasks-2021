import React, { useEffect } from 'react'
import { Link, redirect, useNavigate } from 'react-router-dom'
import styles from './Header.module.css'
import { useAuth } from '../../hooks/useAuth'
import axios from 'axios'
import Button from '../ui/Button/Button'

const Header = () => {
  const {isAuth, setIsAuth, tokenAuth} = useAuth()
  const navigate = useNavigate()

  const logout = () => {

    axios.delete('http://127.0.0.1:8000/api/logout', {
      headers: { 
        'Authorization': `Bearer ${tokenAuth}`
      }
    }).then((res) => {        
        localStorage.removeItem('Blitzo&Stolas');

        setIsAuth(false)
        navigate('login')
        
      }).catch((err) => {
        localStorage.removeItem('Blitzo&Stolas');
        setIsAuth(false)
        navigate('/XX/alatech/login')
      })
  }

  return (
    <header className={styles.header}>
      <a href='/XX/alatech/' ><h2>Alatech</h2></a>
     {!isAuth ? (
       <div className="header__buttons">
         <a href='/XX/alatech/login'>Login</a>
      </div>
     ): (
      <Button onClick={logout} >Logout</Button>
     )}
    </header>
  )
}

export default Header