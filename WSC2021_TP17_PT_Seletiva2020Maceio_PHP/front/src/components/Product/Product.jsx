import React from 'react'
import styles from './Product.module.css'

const Product = ({product}) => {
  return (
   <div key={product.id} className={styles.product}>
      <img src={`http://127.0.0.1:8000/images/${product.imageUrl}.png`} alt="" draggable={false} />
         <div className={styles.product__item} draggable={false} >
         <a href="" draggable={false}>{product.id}. {product.name}</a>
         <div className={styles.product__notification} >
            <h5>{product.name}</h5>
            <h3> {product.brandId? (<>Brand: {product.brandId}</>) :( <></> ) }</h3>
         </div>
         </div>
   </div>
  )
}

export default Product