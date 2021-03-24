CREATE TABLE #TEMPTABLE
(  
Number INT(20),
Value CHAR (20)
)



DECLARE  
@TotalNum INT,
@Num INT,
@Value CHAR (20)


SET @TotalNum = 10
SET @Num =1


WHILE @Num <= @TotalNum 
BEGIN

	SET @Value='這是第'+ CONVERT(varchar,@Num)+'幾次執行'
	

	INSERT #TEMPTABLE (Number,Value)
	           VALUES (@Num,@Value)
	SET @Num = @Num + 1
END

---------------------------------------------------------
CREATE TABLE TEMPTABLE
(  
Number INT(20),
Value CHAR (20)
)



DECLARE  
@TotalNum INT,
@Num INT,
@Value CHAR


SET @TotalNum = 10
SET @Num =1


WHILE @Num <= @TotalNum 
BEGIN

	SET @Value='這是第'+ CONVERT(varchar,@Num)+'幾次執行'
	

	INSERT #TEMPTABLE (Number,Value)
	           VALUES (@Num,@Value)
	SET @Num = @Num + 1
END