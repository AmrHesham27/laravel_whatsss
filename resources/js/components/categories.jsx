import React from "react";

function categories({ categories }) {
    const scroll = (id) => {
      document.getElementById(id).scrollIntoView({ behavior: 'smooth' });
    }
    return (
        <div className="categories">
            <div className="mb-4 categories-header">فئات قائمة الطعام</div>
            {categories.map((category, index) => {
                return <div onClick={() => scroll(`category_${category.id}`)} key={index}>{category["name"]}</div>;
            })}
        </div>
    );
}

export default categories;
