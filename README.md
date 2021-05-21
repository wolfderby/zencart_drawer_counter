# zencart_drawer_counter
# intended to be a simple tool to help quickly count a cash register drawer to determine how much money is in it.
# hope to expand this to calculate if cash is missing from sales receipts from previous day of payment method "cash"
#
# Intended use workflow
# 
# Do an opening drawer count by typing in the number of bills, rolls of coins and coins
#   Total is calculated from these values but can be also be directly typed in
#   Type your initials and any comments
#
# At end of day do a closing drawer count (select "close" in type column)
# 
# The variance column will so any variances your drawer has, meaning if you had $100 in cash (module) sales from #      the day the variance column will show if you're drawer is missing that $100

# The variance calculates from open or close to open or close so if you miss a "type" it will still calculate

#

#Notes on using other "types"

# if you'd like to manually input figures that would adjust a variance from an open/close to an open/close timeframe, simply add a count of any other type (deposit, drawer purchase, refund, owner's contribution, owner's drawer, cash sales etc.) within that time frame


#

# Updated: color coded "heat-mapped w/ opacity" variance 

# TODO:
# Move html outside of PHP tags

# use absolute values of types to force intended math

# admin interface w/ CRUD ability
#    current work around is phpmyadmin
# refactor as object-oriented
#
# Improve appearance of table(s)/headers
# improve page refresh/$_POST data form submit handling