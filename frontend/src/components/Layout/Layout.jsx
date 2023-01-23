import React from 'react'
import { useState } from 'react'
import { useEffect } from 'react'
import Loader from '../UI/Loader/Loader';
import axios from 'axios';

function Layout({children}) {
  const [loaded, setLoaded] = useState(true)//!!!INCLUDE!!!

  useEffect(() => {
    setTimeout(() =>  {
      setLoaded(true)
    }, 3000)
  }, []);
  
  return (
    <div>   
      {loaded? (
        children
       ): ( 
         <Loader/> 
       )} 
    </div>
  )
}

export default Layout