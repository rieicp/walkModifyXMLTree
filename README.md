## Readme ##

### 要点 ###

- 增删节点须多批次分别执行 (foreach)
  - 增删节点配置使用config/premium.php
  - 增删节点处理类为PremiumConfigurationLoader
  
- 添加子节点需要使用xml-snippet
  - 处理类为XmlSnippetLoader

- 其它节点操作可以一批次完成
  - 配置使用config/normal.php
  - 处理类为ConfigurationLoader

### 流程 ###

- 从Kursnet网站下载文件
  - open-Qcat.V1.1.xsd (schema)
    - http://www.kursnet-online.arbeitsagentur.de/onlinekurs/upload/openq/open-Qcat.V1.1.xsd
  - Technische Dokumentation
    - http://www.kursnet-online.arbeitsagentur.de/onlinekurs/upload/openq/open-qcat.v1.1.pdf
  - Leitfaden (Kursnet的Katalog编写规范)
    - https://kursnet-finden.arbeitsagentur.de/kurs/file?fname=Leitfaden%20zur%20Generierung%20von%20open-Q-cat1.pdf
  - open-Qcat-Felder (Kursnet的Katalog的必填域)
    - http://kursnet-finden.arbeitsagentur.de/kurs/file?fname=XML-Felder.xls
  - Starterkit (程序判断XML是否符合Kursnet/open-Qcat要求)
    - https://download-portal.arbeitsagentur.de/files/download?fid=3993&user=Pleines%20IT&sign=b640a01082b933de8e337e96a1bfeb11b3b500022e822d5dc8d9305555772603
    
    
- 自动生成符合.xsd (schema) 的XML
  - 网址：http://xsd2xml.com/
    - 生成文件：Resources/xml/example_auto_01.xml
    
- 利用本软件包自动处理XML
  - test_output_xml.php
    - 输出XML格式
  - test1.php
    - 打印出各个(叶)节点的路径、详情

- 修改/完善配置文件
  - 配置文件
    - config/premium.php
    - config/normal.php    
  - 对照如下文档/资源的信息
    - Online-Validation
      - https://www.freeformatter.com/xml-validator-xsd.html
      - http://www.utilities-online.info/xsdvalidation 
    - Starterkit
    - open-Qcat.V1.1.xsd
    - Technische Dokumentation
    - Leitfaden
    - open-Qcat-Felder

### 资源 ###

- 路径
  - Resources目录

- XML范本文件
  - 由.xsd文件(schema)自动生成
      - Resources/xml/example_auto_01.xml
          - 生成网址：http://xsd2xml.com/
      - 符合open-Qcat.V1.1.xsd的schema
        - Kursnet网站适用的范本XML

  - 手动生成
      - Resources/xml/example_by_hand.xml
        - 符合open-Qcat.V1.1.xsd的schema
          - Kursnet网站适用的范本XML
          
- XML snippet
  - 用于增添XML树的子节点
    - Resources/snippet/education.xml
      - open-Qcat.V1.1.xsd的schema中EDUCATION元素的片段
        - 符合Kursnet网站要求

