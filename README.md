# Intended for use in the admin of zen-cart 1.5.x
# zencart drawer counter
  a simple tool to count a cash register drawer and determine if it's short or over w/ a "variance"

# Intended use workflow

 Do an opening drawer count by typing in the number of bills, rolls of coins and coins
 <p>Total is calculated from these values but can be also be directly typed in</p>
<p>Type your initials and any comments</p>

<p>At end of day do a closing drawer count (select "close" in type column)</p>
 
 <p>The variance column will show any variances your drawer has, meaning if you had $100 in cash (module) sales from the day the variance column will show if you're drawer is missing that $100</p>

 The variance calculates from open or close to open or close so if you miss a "type" it will still calculate

# Notes on using other "types"

 if you'd like to manually input figures that would adjust a variance from an open/close to an open/close timeframe, simply add a count of any other type (deposit, drawer purchase, refund, owner's contribution, owner's drawer, cash sales etc.) within that time frame

# Updated: color coded "heat-mapped w/ opacity" variance (deeper the red the more it's short; darker the green > more it's over)

# TODO:
Move html outside of PHP tags

use absolute values of types to force intended math

admin interface w/ CRUD ability
    current work around is phpmyadmin
refactor as object-oriented

Improve appearance of table(s)/headers
Improve page refresh/$_POST data form submit handling
